import axios from "axios";



const AxiosInstance = axios.create({
    baseURL:'http://127.0.0.1:8000/api/',
    headers:{
        'Accept':'application/json',
        'Access-Control-Allow-Orgin':'*',
        'Accept-language':'en',
    }
});


export default AxiosInstance;