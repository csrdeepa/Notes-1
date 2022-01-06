import React, { useEffect } from 'react'
import { Text, View, Button } from 'react-native'
import { useNavigation } from '@react-navigation/native'
import auth from "@react-native-firebase/auth";
import { GoogleSignin, GoogleSigninButton, statusCodes, } from '@react-native-google-signin/google-signin';
import AsyncStorage from '@react-native-community/async-storage';

import { fetchData } from '../../Redux/Callback/userAuth'

function LogoutScreen(props) {
    const navigation = useNavigation();
    useEffect(() => {
        fetchData();
    }, [props.isuserloggedIN])
    signOut = async () => {
        try {
            let providerId = AsyncStorage.getItem('@providerId')
            if (providerId == 'google.com') {
                await GoogleSignin.revokeAccess();
                await GoogleSignin.signOut()
                    .then(async() => {
                        console.log('User Google signed out!')
                        await AsyncStorage.setItem('@isUserIn', '')
                        navigation.navigate("AuthActions", { name: "Hi" })
                    }
                    );
            } else {
                auth()
                    .signOut()
                    .then(async() => {
                        console.log('User Email signed out!')
                        await AsyncStorage.setItem('@isUserIn', '')
                        navigation.navigate("AuthActions", { name: "Hi" })
                    });
            }
            //   this.setState({ user: null });
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <View>
            <View style={{ margin: 5 }}>
                <Button
                    title="Sign Out"
                    onPress={() => signOut()}
                />
            </View>
        </View>
    )
}

export default LogoutScreen
