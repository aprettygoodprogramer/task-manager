// src/App.tsx

import React from 'react';
import Text from './componets/text';
import LoginTextInput from './componets/loginTextInput';
import './App.css';
import './index.css';

const App: React.FC = () => {
  const handleLogin = (username: string, password: string) => {
    console.log('Login attempt:', { username, password });
  };

  return (
    <div className="App">
      <Text size="large" weight="bold" color='orange' className='h1' fontFamily='Courier New'>
        Login To Task Manager!
      </Text>
      <LoginTextInput onSubmit={handleLogin} />
    </div>
  );
}

export default App;