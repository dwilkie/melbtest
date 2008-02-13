#####################################################################
#   !/bin/sh
#   FILE: modifiy_permissions.sh
#
#   A shell script that recursivley modifies the permissions of all FILES in a specified folder
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-12; Script created. - DCW
#   Version 0.2; 2008-02-13; Reduced to be a permission changing script only and added help and command line options. - DCW
#
#   Usage:
#   modify_permissions [FOLDER]
#   todo:
#####################################################################
if [ $# -eq 0 ] then
  print_help
  exit 1
fi

if test $1="--help" then
  print_help
  exit 0
fi

# find "$1" -type f -exec chmod a-x,a-w,a-r,u+w,u+r,g+r,o+r {} \;

function print_help()
{
  echo "Usage: modify_permissions [OPTION]...FOLDER"
  echo
  echo "Options:"
  echo
  echo "--help"
  return
}
