######################################################################################################################
#   !/bin/sh
#   FILE: rmdir_ftp.sh
#
#   A shell script that can remove a folder on a ftp server
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-21; Script created.
#
#   Usage:
#   rmdir_ftp [OPTIONS]...[DIRECTORY TO DELETE]...[SERVER]...
#   Completely removes DIRECTORY TO DELETE and all of its contents from the server
#   WARNING: Use extreme caution when using this script. Files and folders that are removed cannot be recovered!
#
#   Options:
#   -u XX use username XX instead of anonymous to log into SERVER
#   -p XX use password XX instead of anonymous to log into SERVER
#   --help displays the help file and exits
#
#  Examples:
#  rmdir_ftp -u john -p secret my_unwanted_folder ftp.myserver.com
#   todo:
######################################################################################################################

# Constants
# Default username
USERNAME=anonymous

# Default password
PASSWORD=anonymous

function remove_dir()
{
  echo "DEL $1"
  ncftp3 -u "$user" -p "$pass" "$host" << EOF
  cd $1
  rm *
  bye
EOF
  echo $test
  file_list="$(ncftpls -u $user -p $pass ftp://$host/$1)"
  for dir in $file_list
  do
    parent=$1/`basename "$dir"`
    echo "$parent"
    remove_dir "$parent"
  done
  ncftp3 -u "$user" -p "$pass" "$host" << EOF
  rmdir $1
  bye
EOF
  return
}

# prints help for this script
function print_help()
{
  echo "Usage:"
  echo "rmdir_ftp [OPTIONS]...[DIRECTORY TO DELETE]...[SERVER]..."
  echo "Completely removes DIRECTORY TO DELETE and all of its contents from the server"
  echo "WARNING: Use extreme caution when using this script. Files and folders that are removed cannot be recovered!"
  echo
  echo "Options:"
  echo "-u XX use username XX instead of anonymous to log into SERVER."
  echo "-p XX use password XX instead of anonymous to log into SERVER"
  echo "--help displays the help file and exits"
  echo
  echo "Examples:"
  echo "rmdir_ftp -u john -p secret my_unwanted_folder ftp.myserver.com"
  return
}

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
  -u) user="$2" ; shift 2 ;;
  -p) pass="$2" ; shift 2 ;;
  --help) print_help; exit 0; shift ;;
  -*) print_help; exit 1; shift;;
  *) break;;
  esac
done

# check if number of arguments equals 2
if [ $# -ne 2 ]
then
  print_help
  exit 1
fi

# did the user specify a username
if test -z "$user"
then
  #no - use the default
  user=$USERNAME
fi

# did the user specify a password
if test -z "$pass"
then
  #no - use the default
  pass=$PASSWORD
fi

host=$2
file_list="$(ncftpls -u $user -p $pass ftp://$host/$1)"

if test -z $file_list
then
  echo
  echo "DIRECTORY TO DELETE does not exist"
  print_help
  exit 1
fi

remove_dir "$1"

exit 0
