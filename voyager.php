<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            height: 100%;
            margin: 0;
            width: 100%;
            overflow: hidden;
        }

        #voyager {
            height: 100vh;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/es6-promise/4.0.5/es6-promise.auto.min.js"></script>
    <script src="https://cdn.jsdelivr.net/fetch/0.9.0/fetch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react@16/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom@16/umd/react-dom.production.min.js"></script>

    <!--
      These two files are served from jsDelivr CDN, however you may wish to
      copy them directly into your environment, or perhaps include them in your
      favored resource bundler.
     -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/graphql-voyager/dist/voyager.css"/>
    <script src="https://cdn.jsdelivr.net/npm/graphql-voyager/dist/voyager.min.js"></script>
</head>
<body>
<div id="voyager">Loading...</div>
<script>
    // Defines a GraphQL introspection fetcher using the fetch API. You're not required to
    // use fetch, and could instead implement introspectionProvider however you like,
    // as long as it returns a Promise
    // Voyager passes introspectionQuery as an argument for this function
    function introspectionProvider(introspectionQuery) {
        // This example expects a GraphQL server at the path /graphql.
        // Change this to point wherever you host your GraphQL server.
        return fetch('/graphql.php', {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({query: introspectionQuery}),
            credentials: 'include',
        }).then(function (response) {
            return response.text();
        }).then(function (responseBody) {
            try {
                return JSON.parse(responseBody);
            } catch (error) {
                return responseBody;
            }
        });
    }

    // Render <Voyager /> into the body.
    GraphQLVoyager.init(document.getElementById('voyager'), {
        introspection: introspectionProvider
    });
</script>
</body>
</html>