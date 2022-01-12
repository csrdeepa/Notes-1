//import liraries
import React, { Component } from 'react';
import { View, Text, StyleSheet, TextInput } from 'react-native';

const TextInputWithLable = ({
    label,
    value,
    placeHolder,
    isSecure,
    onChangeText,
    ...props
}) => {

    return (
        <View style={{marginBottom:10}}>
            <Text style={{
                fontSize: 16,
                marginBottom: 8,
                fontWeight: 'bold'
            }}>
                {label}
            </Text>
            <TextInput
                value={value}
                placeholder={placeHolder}
                onChangeText={onChangeText}
                style={styles.inputStyle}
                placeholderTextColor={"gray"}
                
                {...props}
            />
        </View>
    );
};

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#f2f2f2'
    },
    inputStyle: {
        height: 48,
        borderWidth: 1,
        borderColor: 'gray',
        color: 'black',
        paddingHorizontal: 16,
    },
});

export default TextInputWithLable;
