const helper = {
    storePic: async function (picture){

        let question = await axios.post('/temp' , {
            params: {
                file: picture
            }
        })
        return true;
    },

    dateRefactor(date){
        let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        let organize = date.split(' ');
        let day = organize[1];
        let month = organize[0];
        let year = organize[2];

        day = day.slice(0, -1);
        day = (day < 10 ? '0'+day : day);

        for (let i = 0; i < months.length; i++){
            if (month === months[i]){
                month = i + 1;
                month = (month < 10 ? '0'+month : month);
            }
        }

        return year+"-"+month+"-"+day;
    }
}

export { helper };

