const images = {
    storePic: async function (picture){

        let question = await axios.post('/temp' , {
            params: {
                file: picture
            }
        })
        return true;
    }
}

export { images };

