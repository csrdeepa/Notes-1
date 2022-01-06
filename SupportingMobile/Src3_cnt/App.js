import React, { Component } from 'react';
import { Provider } from 'react-redux';

import store from './Redux/Store/Store';
import Routes from './Routes';

export default class App extends Component {
  constructor(props){
        super(props);
    }

    render() {
        return (
            <Provider store={store}>
                <Routes />
            </Provider>
        );
    }
}