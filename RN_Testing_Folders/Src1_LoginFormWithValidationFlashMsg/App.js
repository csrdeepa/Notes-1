import React, { Component } from 'react';
import { View, Text, StyleSheet } from 'react-native';
import Routes from './Navigations/Routes';
import FlashMessage from "react-native-flash-message";

const App = () => {
    return (
        <View style={{flex:1}}>
            <Routes />
            <FlashMessage
                position='top'
            />
        </View>
    );
};

export default App;
