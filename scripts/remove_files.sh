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
#   Version 0.2; 2008-02-18; Added functionality to delete matching files or folders
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

# removes file or folder depending on type
function remove_file()
{
  # check if force option ommitted (normal operation)
  if test $2 -eq 0
  then
    # check if item in question is a file
    if test -f "$1"
    then
      rm "$1"
    else
      rmdir "$1"
    fi
  else
    rm -rf "$1"
  fi
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

# was the hidden option selected
if test $hidden -eq 0
then
  # no - do NOT find files in hidden folders or hidden files themself
  find "$2" -not -regex '.*/\..*' -name "$1" | while read f
  do
    remove_file "$f" $force
  done
else
  #yes - find all files
  find "$2" -name "$1" | while read f
  do
    remove_file "$f" $force
  done
fi
exit 0
