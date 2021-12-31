import React, { Component } from 'react'
import { Text, View, TouchableOpacity } from 'react-native'
import { useDispatch, useSelector } from 'react-redux'
import { vadiveluComedyAction, goundamaniComedyAction } from './App3_redux'

const Comedy = () => {
    const comedies = useSelector(state => state);
    const dispatch = useDispatch();
    return (
        <View>
            <p>{comedies}</p>
            <TouchableOpacity onPress={() => dispatch(vadiveluComedyAction())}>
                <Text>Vadivelu Comedy</Text>
            </TouchableOpacity>
            <TouchableOpacity onPress={() => dispatch(goundamaniComedyAction())}>
                <Text>Goundamani Comedy</Text>
            </TouchableOpacity>
        </View>
    )
}

export default Comedy
