import React from 'react'
import ReactDOM from 'react-dom/client'
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import './styles/background.css'
import App from './routes/App.jsx'
import ListarPerro from './routes/ListarPerro.jsx';
import FormDog from './routes/FormDog.jsx';
const router = createBrowserRouter([
  {
    children: [
      {
        path: '/',
        element: <App/>,
      },
    ],
  },
  {
    path: '/listar-perro',
    element: <ListarPerro/>,
  },
  {
    path: '/form-perro',
    element: <FormDog/>,
  },
]);

ReactDOM.createRoot(document.getElementById('root')).render(
  <RouterProvider router={router} />
);
