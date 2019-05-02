<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>React + Apollo GraphQL Client</title>
    <link
            rel="stylesheet"
            href="//cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css"
    />
    <script src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="jslibs.js"></script>
    <!-- Don't use this in production: -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
</head>
<body>
<div id="root"></div>
<script type="text/babel">
    const libs = window.jslibs;
    const gql = libs['graphql-tag'];

    const Query = libs['react-apollo'].Query;
    const ApolloClient = libs['apollo-client'].ApolloClient;
    const HttpLink = libs['apollo-link-http'].HttpLink;
    const InMemoryCache = libs['apollo-cache-inmemory'].InMemoryCache;
    const semanticUI = libs['semantic-ui-react'];
    const {Container, Dropdown, Loader, List, Image, Menu} = semanticUI;

    // #################################
    // EXERCISE #15
    // INITIALIZE APOLLO AND USE QUERY COMPONENT
    // TO REQUEST A LIST OF CONFERENCES
    // #################################



    ReactDOM.render(
        <Container style={{marginTop: '1em'}}>
            {/* RENDER LIST HERE */}
        </Container>,
        document.getElementById('root')
    );

</script>

</body>
</html>