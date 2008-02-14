######################################################################################################################
#   !/bin/sh
#   FILE: modifiy_permissions.sh
#
#   A shell script that recursivley modifies the optionally specified permissions of all files in a specified folder.
#   If no permissions are specified all files will be reset to the default -rw-r--r--
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-12; Script created. - DCW
#   Version 0.2; 2008-02-13; Reduced to be a permission changing script only and added help. - DCW
#   Version 0.3; 2008-02-14; Added optional arguments for specifying permissions and processing hidden files. - DCW
#
#   Usage:
#   modify_permissions [OPTIONS]...[FOLDER]...
#   Modifies the permissions of each file in FOLDER
#   If no permissions are specified all files will be reset to the default -rw-r--r--
#
#   Options:
#   -p permissions to modify. Either normal or octal mode may be used. See chmod for more info
#   -h process hidden files and files in hidden folders
#   --help displays the help file and exits
#   todo:
######################################################################################################################

#prints help for this script
function print_help()
{
  echo "Usage:"
  echo "modify_permissions [OPTIONS]...FOLDER..."
  echo "Modifies the permissions of each file in FOLDER"
  echo "If no permissions are specified all files will be reset to the default -rw-r--r--"
  echo
  echo "Options:"
  echo "-p permissions to modifiy. Either normal or octal mode may be used. See chmod for more info"
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
  -p) per="$2" ; shift 2 ;;
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done

# did the user specify any permissions
if test -z "$per"
then
  # no - use the default
  exec="chmod a-x,a-w,a-r,u+w,u+r,g+r,o+r"
else
  # yes - use the arguments supplied by the user
  exec="chmod $per"
fi

# did the user supply the hidden option
if test $hidden -eq 0
then
  # no - do NOT find files in hidden folders or hidden files themself
  find "$1" -not -regex '.*/\..*' -type f -exec $exec {} \;
else
  # yes - find all files
  find "$1" -type f -exec $exec {} \;
fi
exit 0
