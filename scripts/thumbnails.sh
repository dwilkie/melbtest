#####################################################################
#   FILE: thumbnails.sh
#
#   A shell script that removes spaces from filenames, changes file permissions, and generates thumbnails from images
#
#   Author:
#   David Wilkie (dwilkie@gmail.com)
#
#   Modified:
#   Version 0.1; 2008-02-12; Script created. - DCW
#   todo:
#######################################################################
clear
find "$1" -type f -exec chmod a-x,a-w,a-r,u+w,u+r,g+r,o+r {} \;
for f in `find "$1" -type f -name "*"`;
do
  echo "$f"
  # file=$(echo $f | tr A-Z a-z | tr ' ' _)
  # mv f file
done
