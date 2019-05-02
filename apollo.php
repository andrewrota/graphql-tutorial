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
    const client = new ApolloClient({
        link: new HttpLink({uri: "/graphql.php"}),
        cache: new InMemoryCache()
    });

    const CONFERENCES_QUERY = gql`query getConferences{
    conferences {
      id
      name
    }
  }
`;
    const CONFERENCE_QUERY = gql`query conferenceInfo($id: Int!) {
  getConferenceById(id: $id) {
    name
    dates
    location
   speakers{
      name
    twitter
    }
  }
}`;

    const ConferenceInfo = ({id}) => (
        id && (<Query client={client} variables={{id}} query={CONFERENCE_QUERY}>
            {({loading, error, data}) => {
                if (loading) return <Loader active/>;
                if (error) return `Error!`;
                return (
                    <Container>
                        <h2>{data.getConferenceById.name}</h2>
                        <h3>{data.getConferenceById.dates} | {data.getConferenceById.location}</h3>
                        <List divided verticalAlign='middle'>
                            {data.getConferenceById.speakers.map((speaker, index) => {
                                const twitterName = /[^/]*$/.exec(speaker.twitter)[0];
                                return (<List.Item key={index}>
                                    <Image avatar
                                           src={'http://avatars.io/twitter/' + (twitterName ? twitterName : '') + '/small'}/>
                                    <List.Content>
                                        <List.Header as='a' href={speaker.twitter} target={"_blank"}
                                                     rel="noreferrer">{speaker.name}</List.Header>
                                    </List.Content>
                                </List.Item>);
                            })}

                        </List>
                    </Container>

                );
            }}
        </Query>)
    );

    const ConferenceSearch = ({id, handleChange}) => <Query client={client} query={CONFERENCES_QUERY}>
        {({loading, error, data}) => {
            if (loading) return 'Loading...';
            if (error) return `Error!`;
            const conferenceOptions = data.conferences.map((conference) => ({
                key: conference.id,
                text: conference.name,
                value: conference.id,
            }))
            return (
                <Menu pointing> <Menu.Item><Dropdown fluid onChange={handleChange} placeholder={"Select Conference"}
                                                     options={conferenceOptions}/></Menu.Item></Menu>
            );
        }}
    </Query>;

    class App extends React.Component {
        constructor(props) {
            super(props);
            this.handleChange = this.handleChange.bind(this);
            this.state = {id: null};
        }

        handleChange = (e, {value}) => this.setState({id: value});

        render() {
            return (<div>
                <ConferenceSearch handleChange={this.handleChange} id={this.state.id}/>

                <ConferenceInfo id={this.state.id}/>
            </div>);
        }
    }

    ReactDOM.render(
        <Container style={{marginTop: '1em'}}>
            <App/>
        </Container>,
        document.getElementById('root')
    );

</script>

</body>
</html>