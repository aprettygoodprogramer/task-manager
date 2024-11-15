import React from 'react';
import Text from './components/text';
import LoginTextInput from './components/loginTextInput';
import './App.css';
import './index.css';

interface LoginResponse {
  success: boolean;
  message: string;
}

const App: React.FC = () => {
  const handleLogin = async (username: string, password: string) => {
    try {
      const backendUrl = "https://aware-beauty.railway.internal:3000";
      

      const response = await fetch(`${backendUrl}/Server/api`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
      });

      if (!response.ok) {
        const errorData = await response.json();
        console.error('Login error:', errorData.error);
        alert(`Error: ${errorData.error}`);
        return;
      }

      const data: LoginResponse = await response.json();

      if (data.success) {
        alert('Login successful!');
      } else {
        alert(`Login failed: ${data.message}`);
      }
    } catch (error) {
      console.error('An unexpected error occurred:', error);
      alert('An error occurred while logging in. Please try again.');
    }
  };

  return (
    <div className="App">
      <Text size="large" weight="bold" color="orange" className="h1" fontFamily="Courier New">
        Login To Task Manager!
      </Text>
      <LoginTextInput onSubmit={handleLogin} />
    </div>
  );
};

export default App;