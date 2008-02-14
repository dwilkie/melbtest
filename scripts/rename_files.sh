######################################################################################################################
#   !/bin/sh
#   FILE: rename_files.sh
#
#   A shell script that recursivley replaces in filenames spaces with underscores and capital letters with small caps.
#   E.g. My File.txt becomes my_file.txt
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-14; Script created - added help, header comments, optional argument for processing hidden files and functionality to modify file names - DCW
#
#   Usage:
#   rename_files [OPTIONS]...[FOLDER]...
#   Renames each file in FOLDER with spaces and/or uppercase letters by replacing spaces with underscores (_) and uppercase letters with their lowercase equivalents (A-a)
#
#   Options:
#   -h process hidden files and files in hidden folders
#   --help displays the help file and exits
#   todo:
######################################################################################################################

#prints help for this script
function print_help()
{
  echo "Usage:"
  echo "rename_files [OPTIONS]...FOLDER..."
  echo "Renames each file in FOLDER with spaces and/or uppercase letters by replacing spaces with underscores (_) and uppercase letters with their lowercase equivalents (A-a)"
  echo
  echo "Options:"
  echo "-h process hidden files and files in hidden folders"
  echo "--help display this help file and exit"
  return
}

#initialise variables
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
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done

if test $hidden -eq 0
then
  files=`find "$1" -not -regex '.*/\..*' -type f`
else
  files=`find "$1" -type f`
fi

for f in $files;
do
 echo "$f"
 # file=$(echo $f | tr A-Z a-z | tr ' ' _)
 # mv f file
done
exit 0