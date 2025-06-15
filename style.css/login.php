/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background: #f0f2f5;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* Login box */
.login-box {
  background: white;
  padding: 30px 40px;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

.login-box h2 {
  margin-bottom: 25px;
  color: #333;
}

form input[type="text"],
form input[type="password"] {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form button {
  width: 100%;
  padding: 12px;
  background-color: #007bff;
  border: none;
  color: white;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
}

form button:hover {
  background-color: #0056b3;
}

.error {
  color: red;
  margin-bottom: 15px;
  font-size: 14px;
}

/* Responsif */
@media (max-width: 480px) {
  .login-box {
    padding: 20px;
  }
}
