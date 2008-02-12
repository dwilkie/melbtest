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
find . -type f -exec chmod a-x,a-w,a-r,u+w,u+r,g+r,o+r {} \;