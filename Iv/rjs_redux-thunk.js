//https://pretagteam.com/question/what-is-the-difference-between-redux-thunk-and-redux-saga 

import { createStore, applyMiddleware } from "redux";

import rootReducer from "./rootReducer";

function logger({
    getState
}) {
    return next => action => {
        console.log("Will dispatch:", action);

        // Call the next dispatch method in the middleware chain.
        const returnValue = next(action);

        console.log("State after dispatch", getState());

        // This will likely be the action itself, unless
        // a middleware further in chain changed it.
        return returnValue;
    }
}

const store = createStore(rootReducer, ["Configure Redux"], applyMiddleware(logger));

store.dispatch({
    type: "ADD_TODO",
    payload: "Understand the middleware",
});

// These lines will be logged by the middleware:
// Will dispatch: {type: "ACTION_TYPE", payload: "Hello, world!"}
// State after dispatch: ["Configure Redux", "Understand the middleware"]
{
    type: "ADD_TODO",
        payload: "Understand the redux-thunk middleware",
}
const addTodo = (payload) => ({
    type: "ADD_TODO",
    payload,
});
function addTodo(payload) {
    return {
        type: "ADD_TODO",
        payload,
    };
}

function addTodoAsync(payload) {
    // We return function instead of an action
    // It receives "dispatch" and "getState" as a parameters
    // We can access the state in the store via "getState()"
    return (dispatch) => {
        setTimeout(() => {
            // Invoke "ADD_TODO" action asynchronously, after 1s
            dispatch(addTodo(payload));
        }, 1000);
    };
}
export const fetchBuildingShape = () => {
    return async (dispatch) => {
        dispatch({
            type: "FETCH_BUILDING_SHAPE",
        });
        try {
            const {
                data
            } = await api.getBuildingShape();
            dispatch({
                type: "FETCH_BUILDING_SHAPE_FULFILLED",
                payload: data,
            });
        } catch (error) {
            dispatch({
                type: "FETCH_BUILDING_SHAPE_REJECTED",
                payload: error.toString(),
            });
        }
    };
};

// Calculation of "x" is immediate
const x = 1 + 2;

// Calculation of "foo" is delayed
// "foo" can be called later to perform the calculation
// "foo" is a thunk
let foo = () => 1 + 2;
