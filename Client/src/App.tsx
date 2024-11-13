// src/App.tsx

import React from 'react';
import axios from 'axios'; // Make sure to install axios: npm install axios
import Text from './componets/text';
import LoginTextInput from './componets/loginTextInput';
import './App.css';
import './index.css';

interface LoginResponse {
  success: boolean;
  message: string;
}

const App: React.FC = () => {
  const handleLogin = async (username: string, password: string) => {
    try {
      const response = await axios.post<LoginResponse>(
        'https://your-railway-app.up.railway.app/login.php',
        { username, password },
        {
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      if (response.data.success) {
        console.log('Login successful:', response.data.message);
            } else {
        console.log('Login failed:', response.data.message);
      }
    } catch (error) {
      console.error('Login error:', error);
    }
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