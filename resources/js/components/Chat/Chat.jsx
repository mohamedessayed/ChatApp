import React, { useEffect, useState } from 'react'
import './chatStyle.css';
import AxiosInstance from '../../api/AxiosInstance';
import Pusher from 'pusher-js';

export default function Chat() {
    const [chatMessage, setChatMessage] = useState('');
    const [messages, setMessages] = useState([]);
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('UserData')))

    const pusher = new Pusher('8ef8d85ed75185b84528',{
        cluster:'eu'
    });

    const channel = pusher.subscribe('appchat-growth');

    const handelChatMessage = (e)=>{
        setChatMessage(e.target.value)
    }

    const handelSendMessage = (e)=>{
        const messageData = {
            message:chatMessage
        }

        AxiosInstance.post('message/send',messageData)
        .then((resposne)=>{
        setChatMessage('')
        })

    }

    useEffect(()=>{

        channel.bind('App\\Events\\ChatMessageEvent',(data)=>{
            setMessages((prevMessage)=>[...prevMessage,data.data])
        });
        
        AxiosInstance.get('message/all')
        .then((response)=>response.data)
        .then((data)=>data.data)
        .then((messages) => {
            setMessages(messages);
        });

        return ()=>{
            channel.unbind_all();
            channel.unsubscribe();
        }

    },[user])

  return (
    <div>
      <div className='chatBox'>
        {messages.map((currentMessage)=><>
        <div key={currentMessage.id} className={currentMessage.email === user.email ? 'sent':'recive'}>
            <p>{currentMessage.message}</p>
        </div>
        </>)}
      </div>

      <div className='sendMessage'>
        <textarea className='block' value={chatMessage} onChange={handelChatMessage} rows={5} name="chatMessage" placeholder='write your message here'></textarea>
        <button className='block' onClick={handelSendMessage}>Send</button>
      </div>
    </div>
  )
}
