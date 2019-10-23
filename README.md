# wycked-wiki
Insecure and minimalistic PHP-MySQL wiki system

# WARNING!

* Do not install or use this software on any server connected to the Internet!

* It is intended for lab and instructional use only, and contains many
  vulnerabilities, both intentional and unintentional!

# Setup

* Copy the contents of the `php` directory to a directory under DocumentRoot

* Edit `config.php` as required

* Load sample SQL data:

  ```
  mysqladmin create wycked
  mysql wycked < sql/00-schema.sql
  mysql wycked < sql/01-pages.sql
  mysql wycked < sql/02-posts.sql
  mysql wycked < sql/03-users.sql
  ```

* Log in using one of the pre-defined users:

  | Username | Password | Access Level
  | --- | --- | ---
  | `admin` | `password` | Administrator (level 8)
  | `alice` | `alice` | User (level 2)
  | `dilbert` | `dilbert` | User (level 2)
  | `rtables` | `xkcd` | Editor (level 4)
  | `wally` | `wally` | User (level 2)

See the included documentation by logging in as an editor or administrator, and
then clicking the `DOCS` button in the menu bar.
