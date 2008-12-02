######################################################################################################################
#   !/bin/sh
#   FILE: thumbnails.sh
#
#   A shell script that recursivley creates thumbnails in gif format from original images using imagemagick
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-18; Script created. Added optional arguments for processing hidden files and folders
#                            and for specifying thumbnail size.
#   Version 0.2; 2008-02-19; Added function for creating a thumbnail given a file path. Added optional
#                            argument for placing thumbnails under version control. Added regex in
#                            find commands to prevent thumnails being created from themselves.
#   Version 0.3; 2008-12-02; Added check to make thumbnail only if it doesn't already exist. Added -mv option 
#                            to move thumbnail into another folder. Added validation for checking that the
#                            folder to search for images is valid and exists. Fixed bug where not 
#                            specifying the second argument to -t caused an infinite loop (see comments
#                            above option handling code)
#
#   Usage:
#   thumbnails [OPTIONS]...[FOLDER]...
#
#   Creates a thumbnail from each image recursivley in FOLDER. By default the image is stored in 
#   the PARENT_FOLDER/thumbs with the same name as the original image in gif format. Supports gif and jpg images.
#
#   Options:
#   -h process hidden files and files in hidden folders
#   -t thumbnail width (pixels) e.g. -t 200 would create a thumbnail 200px wide maintaining aspect ratio
#   -mv [FOLDER] moves the thumbnail into FOLDER e.g. -mv /home/bob/foo would put the thumbnail in 
#       /home/bob/foo/PARENT_FOLDER instead of PARENT_FOLDER/thumbs
#   -v place the thumbnails under version control (subversion). Note subversion must be
#      installed and a repository set up
#   --help displays the help file and exits
#   todo:
######################################################################################################################

# Constants
# Default thumbnail width
THUMB_WIDTH=200

# Output format
OUTPUT_FORMAT=gif

# Output directory name
OUTPUT_DIRECTORY=thumbs


# prints help for this script
function print_help()
{
  echo "Usage:"
  echo "thumbnails [OPTIONS]...FOLDER..."
  echo
  echo "Creates a thumbnail from each image recursivley in FOLDER. By default the image is stored in the PARENT_FOLDER/thumbs with the same name as the original image in gif format. Supports gif and jpg images."
  echo
  echo "Options:"
  echo "-h process hidden files and files in hidden folders"
  echo "-t thumnail width (pixels) e.g. -t 300 would create a thumbnail 300px wide maintaining aspect ratio"
  echo "-mv [FOLDER] moves the thumbnail into FOLDER e.g. -mv /home/bob/foo would put the thumbnail in /home/bob/foo/PARENT_FOLDER instead of PARENT_FOLDER/thumbs"
  echo "-v place the thumbnails under version control (subversion). Note subversion must be installed and a repository set up"
  echo "--help display this help file and exit"
}

# makes a thumbnail given a file name
function make_thumbnail()
{
  # get the filename (without the path) of the original image
  pic_full_name=`basename $1`

  # get the length of the filename
  pic_full_name_length=${#pic_full_name}

  # cut off the last 4 characters from the full name to remove extension (this assumes a 3 letter extension!)
  pic_short_name=${pic_full_name:0:`expr $pic_full_name_length - 4`}

  # get the directory PATH of the original image
  dir_path=`dirname $1`

  # are we 'moving' the thumbnails to another directory
  if test $move_thumbs -eq 1
  then
    # yes - get the directory NAME of the original image
    dir_name=`basename $dir_path`

    # output directory is <path specified by the user after the mv flag>/<parent directory of this image>
    output_path=$move_dir/$dir_name
  else
    # no - output directory is <parent directory of this image>/thumbs
    output_path=$dir_path/$OUTPUT_DIRECTORY
  fi

  # make a directory for the thumbnails if none exists
  if test ! -d $output_path
  then
    mkdir $output_path
  fi

  if test $subversion -eq 1
  then
    svn add $output_path
  fi

  # set the output file name
  output_file=$output_path/$pic_short_name.$OUTPUT_FORMAT
  
  # make thumbnail if it doesn't already exist
  if test ! -f $output_file
  then
    # make the thumbail using imagemagick convert function
    convert $f -thumbnail $thumb_wdth $output_file
  fi
  
  # add thumbnails to version control if specified by user
  if test $subversion -eq 1
  then
    svn add $output_file
  fi
}

# initialise variables
hidden=0
subversion=0
move_thumbs=0

# check if number of arguments equals 0
if [ $# -eq 0 ]
then
  print_help
  exit 1
fi

# the following loop checks the arguments supplied and acts according to the value of the argument
# the shift command moves the argument off the stack. This changes the value of $# (number of arguments)
# as well as the value of $1 (first argument). * is a wildcard and ) is part of the case statement.
# another important fact about the shift command is that supplying shift n, replaces the need for
# shift n times e.g. shift 2 is the same as shift; shift; However if n is larger than possible
# then no arguments are shifted. This could cause an infinite loop if the user specfies for example
# -t with no other argument. In this case shift does nothing and $# remains always at 1 and stuck in the 
# while loop. To prevent this use shift ; n times

while test $# -gt 0
do
  case "$1" in
  -h) hidden=1 ; shift ;;
  -t) tw="$2" ; shift ; shift ;;
  -mv) move_thumbs=1 ; move_dir="$2" ; shift ; shift ;;
  -v) subversion=1 ; shift ;;
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done

# did the user specify the thumbnail width
if test -z "$tw"
then
  #no - use the default
  thumb_wdth=$THUMB_WIDTH
else
  #yes - use their selection
  thumb_wdth="$tw"
fi

# did the user specify to move the thumbnails to a different folder
if test $move_thumbs -eq 1
then
  # yes - did they specify an existing folder to move the thumbs to
  if test -d "$move_dir"
  then
    # yes - remove trailing '/' (if any)
    move_dir=`dirname $move_dir`/`basename $move_dir`
  else
    # no - display error and exit
    echo "The folder in which to move the thumnail to must already exist"
    print_help
    exit 1
  fi
fi

# check to see if the user specified a folder to search in
if test -z "$1"
then
  echo "No folder to search specified"
  print_help
  exit 1
fi

# check to see if the folder they specified actually exists
if test ! -d "$1"
then
  echo "The folder in which to search does not exist"
  print_help
  exit 1
fi

# did the user supply the hidden option
if test $hidden -eq 0
then
  # no - do NOT find files in hidden folders or hidden files themselves. Find all files with allowed extensions except those already in the output 
  # directory. This prevents thumbnails being created from existing thumbnails.
  find "$1" -not -regex ".*/$OUTPUT_DIRECTORY/.*" -not -regex '.*/\..*' -type f -iregex '.*\.\(jpg\|gif\)$' | while read f
  do
    make_thumbnail "$f"
  done
else
  # yes - find all files with allowed extensions except those already in the output directory. This prevents thumbnails being created from existing 
  # thumbnails.
  find "$1" -not -regex ".*/$OUTPUT_DIRECTORY/.*" -type f -iregex '.*\.\(jpg\|gif\)$' | while read f
  do
    make_thumbnail "$f"
  done
fi
exit 0
