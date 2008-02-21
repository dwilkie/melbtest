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
# 
#  Requirements:
#  ncftp3 (http://www.ncftp.com/)
#
#  Bugs:
#
#  todo:
######################################################################################################################

# Constants
# Default username
USERNAME=anonymous

# Default password
PASSWORD=anonymous

# prints help for this script
function print_help()
{
  echo
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

# a recursive function used to remove an entire directory from an ftp server
function remove_dir()
{
  # get a list of files and directories that need to be deleted
  file_list="$(ncftpls -u $user -p $pass -a ftp://$host/$1)"

  # is the list empty
  if test "$file_list"
  then
    # no - therefore the path specified is infact a directory
    # log on to host, change directory into folder that is to be removed and remove all files. Then logoff.
    # << EOF is an input redirection - All lines following << EOF are redirected to the input until EOF is reached in this script.
    # The redirected commands are ftp commands. The marker EOF (can be called anything) must not have spaces in front of it!
    ncftp3 -u "$user" -p "$pass" "$host" << EOF
cd $1
rm *
bye
EOF
    # Now that the FILES have been deleted from the current directory get a new directory listing.
    # There SHOULD only be FOLDERS remaining, however this may not be the case. (e.g. permission errors)
    file_list="$(ncftpls -u $user -p $pass ftp://$host/$1)"
    
    # Go through each directory in the current directory and run this function again
    for dir in $file_list
    do
      remove_dir $1/`basename "$dir"`
    done
    
    # Once the script gets to here the current directory has no more folders in it.
    # Reconnect to the ftp server, remove the current directory and logoff again.
    ncftp3 -u "$user" -p "$pass" "$host" << EOF
rmdir $1
bye
EOF
  fi
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

# initialise variables
host=$2

# get a list of files and directories that need to be deleted
file_list="$(ncftpls -u $user -p $pass ftp://$host/$1)"

# is the list empty
if test -z "$file_list"
then
  # yes - therefore the directory specified does not exist - print message and exit
  echo
  echo "DIRECTORY TO DELETE does not exist"
  print_help
  exit 1
fi

# Remove the directory
remove_dir "$1"
exit 0
