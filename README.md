# RSS Reader Demo

This application reads RSS feeds, allowing the user to import multiple channels and their items to the database

To set up the application, bring the docker containers online

```bash
$ docker compose build --no-cache --force-rm
$ docker compose up -d
```

then on the application server container, run

```bash
$ php artisan migrate:fresh
$ php artisan rss:import
```

This will instantiate the data needed to display the default feed, which is the Official MotoGP News RSS Feed.

Additional or alternative RSS feeds can be imported by providing a valid RSS url to the import command:

```bash
$ php artisan rss:import http://example-feed.com/rss
```

For a quick check on RSS feeds, the read command can be used, which will output channel and item titles to the console.
Once again, an optional parameter can be used to read a feed other than the default MotoGP one

```bash
$ php artisan rss:read
```

Within the application, alt-clicking on any of the stories will display a button to view the article. Alt clicking again will dismiss this button.
