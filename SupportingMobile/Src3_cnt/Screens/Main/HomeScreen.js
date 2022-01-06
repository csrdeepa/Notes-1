import React, { Component, useEffect, useState } from 'react'
import { Text, View } from 'react-native'
import AsyncStorage from '@react-native-community/async-storage';
import LogoutScreen from '../Account/LogoutScreen'
function HomeScreen(props) {
    const [currentuser, setCurrentuser] = useState({ value: '', error: '' });

    useEffect(() => {
        init();
    },[])

    init = async () => {
        const user = await AsyncStorage.getItem('@isUserIn')
        setCurrentuser({ value: user })
        // if (x !== null) {
        //   console.log("XXXXXHOME :", x);
        //   // navigation.navigate("HomeScreen", { name: "Hi" })
        // }
    }
    return (
        <View style={{ width: '100%', height: '100%', justifyContent: 'center', alignItems: 'center' }}>
            <Text> Welcome {currentuser.value}  </Text>
            <LogoutScreen />
        </View>
    )
}

export default HomeScreen
