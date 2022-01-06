import React, { useState } from "react";
import {
    StyleSheet,
    Text,
    View,
    Image,
    TextInput,
    Button,
    TouchableOpacity,
    Alert,
    Keyboard,
    ScrollView, TouchableWithoutFeedback
} from "react-native";

import { Formik } from "formik";
import * as yup from 'yup'

import { resetPassword } from '../../Redux/Callback/userAuth'

function ForgotPassword() {
    const [email, setEmail] = useState("");
    const onSubmit = (values) => {
        setEmail(values.email)
        resetPassword(values.email);
        console.log(JSON.stringify(values));
    }
    const loginValidationSchema = yup.object().shape({
        email: yup
            .string()
            .email("Please enter valid email")
            .required('Email Address is Required'),
    })

    return (

        <ScrollView contentContainerStyle={{ flexGrow: 1 }} keyboardShouldPersistTaps='handled' >
            <View>
                <Text style={{ backgroundColor: '#fff' }}>Forgot Password</Text>
            </View>
            <View style={styles.container}>
                <Formik
                    validationSchema={loginValidationSchema}
                    initialValues={{ email: '' }}
                    onSubmit={values => onSubmit(values)}
                >
                    {({
                        handleChange,
                        handleBlur,
                        handleSubmit,
                        values,
                        errors,
                        isValid,
                    }) => (
                        <View style={{ width: '100%' }}>
                            <View style={{ justifyContent: 'center', alignItems: 'center' }}>
                                <TextInput
                                    name="email"
                                    placeholder="Email Address"
                                    style={styles.TextInput}
                                    onChangeText={handleChange('email')}
                                    onBlur={handleBlur('email')}
                                    value={values.email}
                                    keyboardType="email-address"
                                />
                                {errors.email &&
                                    <Text style={{ fontSize: 10, color: 'red' }}>{errors.email}</Text>
                                }
                            </View>
                            <View style={{ justifyContent: 'center', alignItems: 'center', marginVertical: 10 }}>
                                <Button
                                    onPress={handleSubmit}
                                    title="Submit"
                                    disabled={!isValid}
                                />
                            </View>
                        </View>
                    )}
                </Formik>
            </View>
        </ScrollView>
    );
}

export default ForgotPassword

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: "#fff",
        alignItems: "center",
        justifyContent: "center",
    },

    image: {
        marginBottom: 40,
    },

    inputView: {
        backgroundColor: "#FFC0CB",
        borderRadius: 30,
        width: "70%",
        height: 45,
        marginBottom: 20,

    },

    TextInput: {
        height: 50,
        width: '80%',
        // flex: 1,
        padding: 10,
        marginLeft: 20,
        backgroundColor: "lightgray",
    },

    forgot_button: {
        height: 30,
        marginBottom: 30,
    },

    loginBtn: {
        width: "80%",
        borderRadius: 25,
        height: 50,
        alignItems: "center",
        justifyContent: "center",
        marginTop: 40,
        backgroundColor: "#FF1493",
    },
});