import React, { useState } from 'react'
import './chatStyle.css';

export default function Chat() {
    const [chatMessage, setChatMessage] = useState('');


    const handelChatMessage = (e)=>{
        setChatMessage(e.target.value)
    }

    const handelSendMessage = (e)=>{
        const messageData = {
            message:chatMessage
        }



    }

  return (
    <div>
      <div className='chatBox'>
        <div className='recive'>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Pariatur blanditiis tempore officia illum cumque commodi voluptatibus alias delectus distinctio maxime eligendi asperiores cupiditate, molestias fugiat eos, minus modi. Enim, laboriosam!</p>
        </div>
      </div>
      
      <div className='sendMessage'>
        <textarea className='block' value={chatMessage} onChange={handelChatMessage} name="chatMessage" placeholder='write your message here'></textarea>
        <button className='block' onClick={handelSendMessage}>Send</button>
      </div>
    </div>
  )
}
