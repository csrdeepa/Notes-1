//import liraries
import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView } from 'react-native';

import ButtonWithLoader from '../../Components/ButtonWithLoader';
import TextInputWithLable from '../../Components/TextInputWithLabel';

import validator from '../../utils/validations'
import { showError } from '../../utils/helperFunction';

const Login = ({ navigation }) => {
    const [state, setState] = useState({
        isLoading: false,
        email: '',
        password: '',
        isSecure: true
    })
    const { isLoading, email, password, isSecure } = state
    const updateState = (data) => setState(() => ({ ...state, ...data }))

    const isValidData = () => {
        const error = validator({
            email,
            password
        })
        if (error) {
            showError(error) //alert(error)
            return false
        }
        return true
    }

    const onLogin = () => {
        const checkValid=isValidData()
        if(checkValid){
        navigation.navigate('Signup');            
        }

        // if (email == '' || password == '') {
        //     alert("Please fill your email and password")
        //     return
        // }
        // navigation.navigate('Signup');
    }
    return (
        <View style={styles.container}>
            <TextInputWithLable
                label={"Enter Email"}
                placeHolder={"enter your email"}
                onChangeText={(email) => updateState({ email })}
            />
            <TextInputWithLable
                label={"Password"}
                placeHolder={"enter your password"}
                secureTextEntry={true}
                onChangeText={(password) => updateState({ password })}
            />

            <ButtonWithLoader
                text='Login'
                onPress={onLogin}
            />
        </View>
    );
};


const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 24
    },
});


export default Login;
