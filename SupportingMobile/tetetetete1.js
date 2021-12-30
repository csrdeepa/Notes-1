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

export default function App1() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const onSubmit = () => {
        Alert.alert(`Welcome Email ${email} Password${password}`);
    }
    return (
        
        <ScrollView contentContainerStyle={{ flexGrow: 1 }} keyboardShouldPersistTaps='handled' >

            <View style={styles.container}>
                {/* <Image style={styles.image} source={require("./assets/log2.png")} /> */}
                <Image
                    source={{
                        uri: 'https://reactjs.org/logo-og.png',
                        method: 'POST',
                        headers: {
                            Pragma: 'no-cache'
                        },
                        body: 'Your Body goes here'
                    }}
                    style={{ width: 100, height: 100 }}
                />

                <View style={styles.inputView}>
                    <TextInput
                        style={styles.TextInput}
                        placeholder="Email."
                        placeholderTextColor="#003f5c"
                        onChangeText={(email) => setEmail(email)}
                    />
                </View>

                <View style={styles.inputView}>
                    <TextInput
                        style={styles.TextInput}
                        placeholder="Password."
                        placeholderTextColor="#003f5c"
                        secureTextEntry={true}
                        onChangeText={(password) => setPassword(password)}
                    />
                </View>

                <TouchableOpacity>
                    <Text style={styles.forgot_button}>Forgot Password?</Text>
                </TouchableOpacity>

                <TouchableOpacity style={styles.loginBtn} onPress={() => onSubmit()}>
                    <Text style={styles.loginText}>LOGIN</Text>
                </TouchableOpacity>

            </View>

            <View>
                <Formik
                    initialValues={{ email: '', password: '' }}
                    onSubmit={values => console.log(values)}
                >
                    {({ handleChange, handleBlur, handleSubmit, values }) => (
                        <>
                            <TextInput
                                name="email"
                                placeholder="Email Address"
                                style={styles.textInput}
                                onChangeText={handleChange('email')}
                                onBlur={handleBlur('email')}
                                value={values.email}
                                keyboardType="email-address"
                            />
                            <TextInput
                                name="password"
                                placeholder="Password"
                                style={styles.textInput}
                                onChangeText={handleChange('password')}
                                onBlur={handleBlur('password')}
                                value={values.password}
                                secureTextEntry
                            />
                            <Button onPress={handleSubmit} title="Submit" />
                        </>
                    )}
                </Formik>
            </View>
        </ScrollView>
    );
}

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
        flex: 1,
        padding: 10,
        marginLeft: 20,
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
