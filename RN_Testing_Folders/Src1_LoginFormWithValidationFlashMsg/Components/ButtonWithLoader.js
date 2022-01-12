//import liraries
import React, { Component } from 'react';
import { View, Text, StyleSheet } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';

// create a component
const ButtonWithLoader = ({
    text,
    onPress
}) => {
    return (
        <TouchableOpacity style={styles.btnStyle} onPress={onPress}>
            <Text style={styles.textStyle}>{text}</Text>
        </TouchableOpacity>
    );
};

const styles = StyleSheet.create({
btnStyle:{
    height:48,
    borderWidth:1,
    backgroundColor:'blue',
    alignItems:'center',
    justifyContent:'center',
    borderRadius:4,
},
textStyle:{
    fontSize:16,
    textTransform:'uppercase',
    fontWeight:'bold',
    color:'white'
}
});

export default ButtonWithLoader;
