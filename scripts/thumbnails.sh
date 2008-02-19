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
#   Version 0.1; 2008-02-18; Script created. Added optional arguments for processing hidden files and folders and for specifying thumbnail size.
#   Version 0.2; 2008-02-19; Added function for creating a thumbnail given a file path. Added optional argument for placing thumbnails under version 
#                            control. Added regex in find commands to prevent thumnails being created from themselves.
#
#   Usage:
#   thumbnails [OPTIONS]...[FOLDER]...
#   Creates a thumbnail from each image recursivley in FOLDER. The image is stored in /thumbs with the same name as the original image in gif format. Supports gif and jpg images.
#
#   Options:
#   -h process hidden files and files in hidden folders
#   -t thumbnail width (pixels) e.g. -t 200 would create a thumbnail 200px wide maintaining aspect ratio
#   -v place the thumbnails under version control (subversion). Note subversion must be installed and a repository set up"
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
  echo "Creates a thumbnail from each image recursivley in FOLDER. The image is stored in /thumbs with the same name as the original image in gif format. Supports gif and jpg images."
  echo
  echo "Options:"
  echo "-h process hidden files and files in hidden folders"
  echo "-t thumnail width (pixels) e.g. -t 300 would create a thumbnail 300px wide maintaining aspect ratio"
  echo "-v place the thumbnails under version control (subversion). Note subversion must be installed and a repository set up"
  echo "--help display this help file and exit"
  return
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

  # get the directory of the original image
  dir_name=`dirname $1`

  # make a directory for the thumbnails if none exists
  if test ! -d $dir_name/$OUTPUT_DIRECTORY
  then
    mkdir $dir_name/$OUTPUT_DIRECTORY
  fi

  if test $subversion -eq 1
  then
    svn add $dir_name/$OUTPUT_DIRECTORY
  fi

  # set the output file name
  output_file=$dir_name/$OUTPUT_DIRECTORY/$pic_short_name.$OUTPUT_FORMAT

  # make the thumbail using imagemagick convert function
  convert $f -thumbnail $thumb_wdth $output_file
  
  # add thumbnails to version control if specified by user
  if test $subversion -eq 1
  then
    svn add $output_file
  fi
}

# initialise variables
hidden=0
subversion=0

# check if number of arguments equals 0
if [ $# -eq 0 ]
then
  print_help
  exit 1
fi

# the following loop checks the arguments supplied acts according to the value of the arguement
# the shift command moves the argument off the stack. This changes the value of $# (number of arguments)
# as well as the value of $1 (first argument). * is a wildcard and ) is part of the case statement.
while test $# -gt 0
do
  case "$1" in
  -h) hidden=1 ; shift ;;
  -t) tw="$2" ; shift 2 ;;
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
