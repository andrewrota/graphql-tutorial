## LonghornPHP 2019 GraphQL Tutorial

This is the example application for the [Build a GraphQL API with PHP tutorial](https://www.longhornphp.com/sessions/#build-a-graphql-api-with-php-tutorial) at the [Longhorn PHP 2019 Conference](https://www.longhornphp.com/).

### Branches

* `master` branch is meant to be the starting point for the tutorial, and so most functionality initially will not work.
* `complete` branch is the completed application, available for reference

### Objective

The objective of this tutorial is to build a simple GraphQL API that displays a sample selection of PHP conferences with associated speakers.

![GraphQL API](images/completed_api.png "GraphQL API")
![App UI](images/completed_example.png "App UI")

### Schema

The eventual GraphQL schema will look like this:

![GraphQL Schema](images/completed_schema.png "GraphQL Schema")

The underlying data is stored in a sqlite databse (`phpconferences.sqlite`) and looks like this: 

![DB Schema](images/completed_db.png "DB Schema")

