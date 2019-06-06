## GraphQL Tutorial (2019).

This is the example application for the Build a GraphQL API with PHP tutorial presented at various conferences in 2019.

**Slides:** [slideshare.net/andrewrota/tutorial-building-a-graphql-api-in-php/](https://www.slideshare.net/andrewrota/tutorial-building-a-graphql-api-in-php/)

**Starting Code (Glitch):** [bit.ly/graphql-code-glitch](bit.ly/graphql-code-glitch)

**Complete App:** [bit.ly/complete-graphql-php-app](https://bit.ly/complete-graphql-php-app) 

### Branches

* `master` branch is meant to be the starting point for the tutorial, and so most functionality initially will not work.
* `complete` branch is the completed application, available for reference

### Getting Started

For this tutorial, I recommend using the Glitch coding environment to edit and run the code.

However, you can also run it locally.

Requirements: PHP 7.2 w/ SQLite, and Composer

To start: `composer install; composer run start --timeout=0`

### Objective

The objective of this tutorial is to build a simple GraphQL API that displays a sample selection of PHP conferences with associated speakers.

![GraphQL API](images/completed_api.png "GraphQL API")
![App UI](images/completed_example.png "App UI")

### Schema

The eventual GraphQL schema will look like this:

```graphql schema
type Query {
  message(name: String): String
  speakers: [Speaker]
  conferences(nameFilter: String): [Conference]
  getConferenceById(id: Int): Conference
}


type Mutation {
  addSpeaker(name: String!, twitter: String): CreateSpeakerOutput
}

type Conference {
  id: Int!
  name: String!
  url: String!
  description: String
  location: String
  dates: String!
  speakers: [Speaker]
}

type Speaker {
  id: Int!
  name: String
  twitter: String
}

type CreateSpeakerOutput {
  id: Int
}

```

![GraphQL Schema](images/completed_schema.png "GraphQL Schema")

The underlying data is stored in a sqlite databse (`phpconferences.sqlite`) and looks like this: 

![DB Schema](images/completed_db.png "DB Schema")

