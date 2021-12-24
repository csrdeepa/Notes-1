// JSON recursive reduce:
// Method1:
const array=[{id:1,name:"bla",children:[{id:23,name:"bla",children:[{id:88,name:"bla"},{id:99,name:"bla"}]},{id:43,name:"bla"},{id:45,name:"bla",children:[{id:43,name:"bla"},{id:46,name:"bla"}]}]},{id:12,name:"bla",children:[{id:232,name:"bla",children:[{id:848,name:"bla"},{id:959,name:"bla"}]},{id:433,name:"bla"},{id:445,name:"bla",children:[{id:443,name:"bla"},{id:456,name:"bla",children:[{id:97,name:"bla"},{id:56,name:"bla"}]}]}]},{id:15,name:"bla",children:[{id:263,name:"bla",children:[{id:868,name:"bla"},{id:979,name:"bla"}]},{id:483,name:"bla"},{id:445,name:"bla",children:[{id:423,name:"bla"},{id:436,name:"bla"}]}]}];

const findItemNested = (arr, itemId, nestingKey) => (
  arr.reduce((a, item) => {
    if (a) return a;
    if (item.id === itemId) return item;
    if (item[nestingKey]) return findItemNested(item[nestingKey], itemId, nestingKey)
  }, null)
);
const res = findItemNested(array, 959, "children");
console.log(res);

// Method2:
test = {
    "id":"0",
    "children":[
        {
            "id":"1",
            "children":[...]
        },
        {
            "id":"2",
            "children":[...]
        }
    ]
}
// function findNode(10, 'children');

function findNode(id, currentNode) {
    var i,
        currentChild,
        result;

    if (id == currentNode.id) {
        return currentNode;
    } else {

        // Use a for loop instead of forEach to avoid nested functions
        // Otherwise "return" will not work properly
        for (i = 0; i < currentNode.children.length; i += 1) {
            currentChild = currentNode.children[i];

            // Search in the current child
            result = findNode(id, currentChild);

            // Return the result if the node has been found
            if (result !== false) {
                return result;
            }
        }

        // The node has not been found and we have no more options
        return false;
    }
}

// Lodash/JS to recursively filter nested objects:
function find(id, array) {
    var result;
    array.some(o => o.id === id && (result = o) || (result = find(id, o.children || [])));
    return result;
}

var objects = [{ id: 1, name: 'foo' }, { id: 2, name: 'bar', children: [{ id: 3, name: 'baz', children: [{ id: 4, name: 'foobar' }] }] }];

console.log(find(1, objects));
console.log(find(2, objects));
console.log(find(3, objects));
console.log(find(4, objects));
