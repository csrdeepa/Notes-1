import React, { useEffect } from 'react';
import { View, Text } from 'react-native';

export default function SplashLoad(props) {
    function goToList() {
        setTimeout(() => {
            props.navigation.push('AuthActions')
        }, 5000)
    }
    return (
        <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
            <Text>Fetching data...</Text>
            {
                goToList()
            }
        </View>
    )
}