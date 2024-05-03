# XSS LAB

Thanks to this repo, you'll be able to create a vulnerable VM to perform a simple XSS (Cross-Site Scripting).

The goal of it it to demonstrate and discover what is XSS

The install script has been tested on Debian.

## Install

### Create the VM

First create a Debian VM. A simple one with no GUI is enough. Just enable ssh.

During installation, create a user. It will be used to set the vulnerable website and it will be automatically deleted at the end.

Once the VM is created, connect to it, and give sudo role to the user

```bash
ssh myuser@myvm
su -
adduser myuser sudo
```

Also, install git: `sudo apt install git`

### Make it vulnerable

```bash
git clone https://github.com/olivierprotips/XSS-LAB
cd XSS-LAB
chmod +x install.sh
sudo ./install.sh
```

### Demo mode

By default, XSS-LAB is depoyed in automatic mode. It means that users messages are read automatically (to trigger XSS). That way, you can play in standalone.

In case of demonstration, it can be disabled, meaning that you will play the admin. You will have to display the "Read User Messages" to trigger XSS.

To activate the demo mode, after having retrieved the Git Repo :

```bash
chmod +x install.sh
sudo ./install.sh demo
```

Note: it is done at install. Modes cannot be switched after.