  #include <stdlib.h>
  #include <sys/types.h>
  #include <unistd.h>
  #include <stdio.h>
  #include <string.h>

  int
  main (int argc, char *argv[])
  {
     setuid (0);
     /* WARNING: Only use an absolute path to the script to execute,
      *          a malicious user might fool the binary and execute
      *          arbitary commands if not.
      * */
     char command[100] = {0};
     char vzctl[] = "/bin/sh /usr/local/smartpanel/core/execute.sh";
     char vzlist[] = "/bin/sh /usr/local/smartpanel/core/list.sh";


     if (strcmp(argv[1], "status") == 0)
     {
      sprintf(command, "%s -o status,laverage,diskspace --no-header %s", vzlist, argv[2]);
      system(command);
      sprintf(command, "%s exec %s free -m | grep Mem:", vzctl, argv[2]);
      system(command);
      sprintf(command, "%s exec %s free -m | grep Swap:", vzctl, argv[2]);
      system(command);
      sprintf(command, "%s -o disabled %s -H", vzlist, argv[2]);
      system(command);
     }
     else if(strcmp(argv[1], "start") == 0 || strcmp(argv[1], "restart") == 0 || strcmp(argv[1], "stop") == 0)
     {
       sprintf(command, "%s %s %s", vzctl, argv[1], argv[2]);
       system(command);
     }
     else if (strcmp(argv[1], "hostname") == 0)
     {
       sprintf(command, "%s set %s --save --hostname %s", vzctl, argv[2], argv[3]);
       system(command);
     }
     else if (strcmp(argv[1], "rootpass") == 0)
     {
       sprintf(command, "%s set %s --save --userpasswd root:%s", vzctl, argv[2], argv[3]);
       system(command);
     }
     else if (strcmp(argv[1], "reinstall") == 0)
     {
       sprintf(command, "%s stop %s", vzctl, argv[2]);
       system(command);
       sprintf(command, "rm -rf /vz/private/%s", argv[2]);
       system(command);
       sprintf(command, "%s create %s --ostemplate %s", vzctl, argv[2], argv[3]);
       system(command);
       sprintf(command, "%s start %s", vzctl, argv[2]);
       system(command);
     }
     else if (strcmp(argv[1], "tuntap") == 0)
     {
       if (strcmp(argv[3], "on") == 0)
       {
         sprintf(command, "%s set %s --devnodes net/tun:rw --capability net_admin:on --save", vzctl, argv[2]);
         system(command);
       } else if (strcmp(argv[3], "off") == 0) {
         sprintf(command, "%s set %s --devnodes net/tun:none --capability net_admin:off --save", vzctl, argv[2]);
         system(command);
       }
     }
     else if (strcmp(argv[1], "fuse") == 0)
     {
       if (strcmp(argv[3], "on") == 0)
       {
         sprintf(command, "%s set %s --devices c:10:229:rw --save", vzctl, argv[2]);
         system(command);
       } else if (strcmp(argv[3], "off") == 0) {
         sprintf(command, "%s set %s --devices c:10:229:none --save", vzctl, argv[2]);
         system(command);
       }
     }
     else if (strcmp(argv[1], "ip") == 0)
     {
       if (strcmp(argv[3], "list") == 0)
       {
         sprintf(command, "%s -o ip -H %s", vzlist, argv[2]);
         system(command);
       } else if (strcmp(argv[3], "add") == 0) {
         sprintf(command, "%s set %s --ipadd %s --save", vzctl, argv[2], argv[4]);
         system(command);
       } else if (strcmp(argv[3], "del") == 0) {
         sprintf(command, "%s set %s --ipdel %s --save", vzctl, argv[2], argv[4]);
         system(command);
       }
     }


     return 0;
   }
