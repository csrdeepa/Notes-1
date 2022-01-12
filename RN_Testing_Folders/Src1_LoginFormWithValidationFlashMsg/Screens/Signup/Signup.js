//import liraries
import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView } from 'react-native';

import ButtonWithLoader from '../../Components/ButtonWithLoader';
import TextInputWithLable from '../../Components/TextInputWithLabel';

import validator from '../../utils/validations'
import { showError } from '../../utils/helperFunction';

const Signup = ({ navigation }) => {
    const [state, setState] = useState({
        isLoading: false,
        userName:'',
        email: '',
        password: '',
        isSecure: true
    })
    const { isLoading, userName, email, password, isSecure } = state
    const updateState = (data) => setState(() => ({ ...state, ...data }))

    const isValidData = () => {
        const error = validator({
            userName,
            email,
            password
        })
        if (error) {
            showError(error) 
            return false
        }
        return true
    }

    const onLogin = () => {
        const checkValid=isValidData()
        if(checkValid){
        navigation.navigate('Signup');            
        }
 
    }
    return (
        <View style={styles.container}>
            <TextInputWithLable
                label={"Enter Username"}
                placeHolder={"enter your username"}
                onChangeText={(userName) => updateState({ userName })}
            />
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
                text='Signup'
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


export default Signup;
