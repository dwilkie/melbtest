######################################################################################################################
#   !/bin/sh
#   FILE: remove_files.sh
#
#   A shell script that recursivley removes files or folders with a given name
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-14; Script created - added help, header comments, optional arguments for processing hidden files and forcing deletion of folders - DCW
#
#   Usage:
#   remove_files [OPTIONS]...[ITEM TO DELETE]...[FOLDER]...
#   Removes each occurence of a filename or folder name recursivley in FOLDER
#   WARNING: Use extreme caution when using this script. Files and folders that are removed cannot be recovered!
#
#   Options:
#   -h process hidden files and files in hidden folders
#   -f force removal of non-empty folders
#   --help displays the help file and exits
#   todo:
######################################################################################################################

# prints help for this script
function print_help()
{
  echo "Usage:"
  echo "remove_files [OPTIONS]...[ITEM TO DELETE]...FOLDER..."
  echo "Removes each occurence of a filename or folder name recursivley in FOLDER."
  echo "WARNING: Use extreme caution when using this script. Files and folders that are removed cannot be recovered!"
  echo
  echo "Options:"
  echo "-h process hidden files and files in hidden folders"
  echo "-f force removal of non-empty folders"
  echo "--help display this help file and exit"
  return
}

# initialise variables
hidden=0
force=0

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
  -f) force=1 ; shift ;;
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done