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
#   Version 0.1; 2008-02-18; Script created, optional arguments for processing hidden files and folders and for specifying thumbnail size and added functionality for creating thumbnails
#
#   Usage:
#   thumbnails [OPTIONS]...[FOLDER]...
#   Creates a thumbnail from each image recursivley in FOLDER. The image is stored in /thumbs with the same name as the original image in gif format. Supports gif and jpg images.
#
#   Options:
#   -h process hidden files and files in hidden folders
#   -t thumbnail width (pixels) e.g. -t 200 would create a thumbnail 200px wide maintaining aspect ratio
#   --help displays the help file and exits
#   todo:
######################################################################################################################

# Constants
# Default thumbnail width
$THUMB_WIDTH = 200

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
  echo "--help display this help file and exit"
  return
}

# initialise variables
hidden=0

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
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done

# did the user specify the thumbnail width
if test -z "$tw"
then
  #no - use the default
  $thumb_wdth = $THUMB_WIDTH
else
  #yes - use their selection
  $thumb_wdth = "$tw"
fi

# did the user supply the hidden option
if test $hidden -eq 0
then
  # no - do NOT find files in hidden folders or hidden files themself
  find "$1" -not -regex '.*/\..*' -type f -iregex '.*\.\(jpg\|gif\)$' -exec convert '{}' -thumbnail $thumb_wdth thumbs/'{}'.gif \;
else
  # yes - find all files
  find "$1" -type f -iregex '.*\.\(jpg\|gif\)$' -exec convert '{}' -thumbnail $thumb_wdth thumbs/'{}'.gif \;
fi
exit 0