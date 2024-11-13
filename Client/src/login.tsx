import axios from 'axios';

interface LoginResponse {
  success: boolean;
  user?: {
    id: number;
    username: string;
  };
  message?: string;
}

async function loginUser(username: string, password: string): Promise<LoginResponse> {
  try {
    const response = await axios.post('https://aware-beauty-production.up.railway.app/Server/login.php', {
      username,
      password
    });
    return response.data;
  } catch (error) {
    console.error('Login error:', error);
    return { success: false, message: 'An error occurred during login' };
  }
}

export default loginUser;