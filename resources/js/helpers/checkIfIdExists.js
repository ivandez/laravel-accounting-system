// Check if id exists in array
export const checkIfIdExists = (id, array) => {
    for (let i = 0; i < array.length; i++) {
        if (array[i].id === id) {
            return true;
        }
    }
    return false;
};
