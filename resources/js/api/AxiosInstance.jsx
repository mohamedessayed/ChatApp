import axios from "axios";



const AxiosInstance = axios.create({
    baseURL:'',
    headers:{
        'Accept':'application/json',
        'Access-Control-Allow-Orgin':'*',
        'Accept-language':'en',
    }
});


export default AxiosInstance;