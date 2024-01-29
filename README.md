Requirements
------------------
- PHP8.1
- composer2

###Step 1:

```bash
git clone https://github.com/kailashkds/chaincommand.git
composer install
```

###Step 2:
To test chain of command working properly I have added below in config\packages\chain_command_bundle.yaml

```yaml
chain_command:
  chains:
    foo:hello:  # root command name
      - bar:hi:  # member command name
```

###Step 3:
To test individual command working fine comment bellow lines
congig
```yaml
    foo:hello:  # root command name
      - bar:hi:  # member command name
```
then execute
```bash
  php bin/console foo:hello
  php bin/console bar:hi
```
you will see all command executing properly

###Step 3:
To test chain of command uncomment above an run
```bash
  php bin/console foo:hello
```
open logfile at below path to check logs
```bash
  {{path to project}}/var/log/dev-chainCommand.log
```
when you execute chain command independelty it will give error
```bash
  php bin/console bar:hi
```
###Step 3:
Run test cases 
```bash
  php bin/phpunit
```
