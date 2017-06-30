#!/bin/bash
echo -e "\e[34m\e[1m##############################\n"
echo -e "\e[34m\e[1m#                            #\n"
echo -e "\e[34m\e[1m#       \e[32m\e[1mXCraft   \e[35m\e[1mFull-6      \e[34m\e[1m#\n"
echo -e "\e[34m\e[1m#                  \e[33m\e[1mby:量子   \e[34m\e[1m#\n"
echo -e "\e[34m\e[1m##############################\e[0m\n"
echo ""
echo "即将开始安装multicraft"
rm -f xcraft1.1.0.sh
wget -c -q http://liangzi.xicp.net/xcraft/xcraft1.1.0.sh -O xcraft1.1.0.sh
chmod +x xcraft1.1.0.sh
./xcraft1.1.0.sh