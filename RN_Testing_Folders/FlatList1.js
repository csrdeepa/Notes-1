import * as React from 'react';
import { FlatList, StyleSheet, Text, View, Alert, TextInput, TouchableOpacity } from 'react-native';

export default function TestFlatList1() {
    const [currentIndex, setCurrentIndex] = React.useState(0)
    const [search, setSearch] = React.useState(false)
    const [searchid, setSearchid] = React.useState('')
    const [Searchdata, setSearchdata] = React.useState([])

    const callClose = (status) => { setSearch(status) }

    const callSearch = async (searchitem) => {
        setSearch(true)
        let searchresult = await finddatatest(testdata, searchid) .filter(function (e) { return e })
        finddatatest(testdata, searchid)
        setSearchdata(searchresult[0])
        console.log("VVVVVVVV :", JSON.stringify(searchresult));
    }

    function finddatatest(data, searchid) {
        return data.map((item, index) => {
            let x = item.list.find(e => e.id == searchid)
            if (x) {
                setCurrentIndex(index)
                return x 
            } 
        })
    }
    function finddata(data, value) {
        return data.map((item, index) => {
            return item.list.find(e => e.id == value)
        })
    }

    const renderItem = ({ item, index }) => (
        <View key={index}
            style={currentIndex == index ? styles.SelectedlistItem : styles.listItem} >
            <Text onPress={() => setCurrentIndex(index)}> {item.title} </Text>
        </View>
    );

    const onPressFunction = () => {

    }

    const test = () => {
        <View style={{ padding: 5 }}>
            <Text onPress={() => alert(JSON.stringify(item) + "   Index :" + index)}> {item.title} </Text>
            <Text onPress={() => alert(JSON.stringify(testdata[index]))}> {item.title} </Text>
        </View>
    }

    return (
        <View style={{ marginTop: 100 }}>
            {/* <Header Bar headName={'Select Vehicle'} searchPress={callSearch} closePress={callClose} /> */}
            <View style={{ flexDirection: 'row', padding: 10 }}>
                <TextInput
                    style={{ width: '50%', backgroundColor: '#f2f2f2' }}
                    placeholder='Search'
                    defaultValue={searchid}
                    onChangeText={setSearchid}
                />
                <TouchableOpacity
                    onPress={() => callSearch()}
                    style={{ padding: 10, backgroundColor: 'blue', color: 'white', margin: 10 }}>
                    <Text style={{ color: 'white' }}>Search</Text>
                </TouchableOpacity>
            </View>
            <FlatList
                data={testdata}
                renderItem={renderItem}
                keyExtractor={(item) => item.title}
                horizontal
            />
            <View>
                {!search &&
                    testdata[currentIndex].list.map((item) => (
                        <View style={{ flexDirection: 'row' }} key={item.id}>
                            <Text>{item.id}</Text>
                            <Text>{item.status}</Text>
                        </View>
                    ))
                }
            </View>

            <View>
                {
                    Searchdata &&
                    <View style={{ flexDirection: 'row' }} key={Searchdata.id}>
                        <Text>{Searchdata.id}</Text>
                            <Text>{Searchdata.status}</Text>

                    </View>

                }
            </View>
        </View>
    );
}

var testdata = [
    {
        title: 'topNode1',
        list: [
            { id: 11, status: 'node11' },
            { id: 12, status: 'node12' },
            { id: 13, status: 'node13' },
            { id: 14, status: 'node14' },
            { id: 15, status: 'node15' },
            { id: 16, status: 'node16' },
        ],
    },
    {
        title: 'topNode2',
        list: [
            { id: 21, status: 'node21' },
            { id: 22, status: 'node22' },
            { id: 23, status: 'node23' },
            { id: 24, status: 'node24' },
            { id: 25, status: 'node25' },
            { id: 26, status: 'node26' },
        ],
    },
    {
        title: 'topNode3',
        list: [
            { id: 31, status: 'node31' },
            { id: 32, status: 'node32' },
            { id: 33, status: 'node33' },
            { id: 34, status: 'node34' },
            { id: 35, status: 'node35' },
            { id: 36, status: 'node36' },
        ],
    },
    {
        title: 'topNode4',
        list: [
            { id: 41, status: 'node41' },
            { id: 42, status: 'node42' },
            { id: 43, status: 'node43' },
            { id: 44, status: 'node44' },
            { id: 45, status: 'node45' },
            { id: 46, status: 'node46' },
        ],
    },
    {
        title: 'topNode5',
        list: [
            { id: 51, status: 'node51' },
            { id: 52, status: 'node52' },
            { id: 53, status: 'node53' },
            { id: 54, status: 'node54' },
            { id: 55, status: 'node55' },
            { id: 56, status: 'node56' },
        ],
    },
    {
        title: 'topNode6',
        list: [
            { id: 61, status: 'node61' },
            { id: 62, status: 'node62' },
            { id: 63, status: 'node63' },
            { id: 64, status: 'node64' },
            { id: 65, status: 'node65' },
            { id: 66, status: 'node66' },
        ],
    },
];



const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#f2f2f4',
        alignItems: 'center',
    },
    listItem: {
        flexDirection: 'row',
        marginTop: 5,
    },
    SelectedlistItem: {
        flexDirection: 'row',
        marginTop: 5,
        backgroundColor: "green",
        borderBottomWidth: 3
    },

})
