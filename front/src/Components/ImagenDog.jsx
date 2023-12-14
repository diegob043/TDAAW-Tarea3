import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Card, CardMedia } from '@mui/material';

const ImagenPerro = ({ onImageUrlChange }) => {
  const [dogImage, setDogImage] = useState('');

  const fetchDogImage = async () => {
    try {
      const imageUrl = await getRandomDogImage();
      setDogImage(imageUrl);

      // Llamar a la función de devolución de llamada con la URL de la imagen
      onImageUrlChange(imageUrl);
    } catch (error) {
      console.error('Error fetching dog image:', error);
    }
  };

  useEffect(() => {
    if (!dogImage) {
      fetchDogImage();
    }
  }, [dogImage, onImageUrlChange]);

  const getRandomDogImage = async () => {
    try {
      const response = await axios.get('https://dog.ceo/api/breeds/image/random');
      const url = response.data.message;
      console.log(url);
      return url;
    } catch (error) {
      console.error('Error fetching dog image:', error);
      throw error;
    }
  };

  const handleGetAnotherDog = () => {
    fetchDogImage();
  };

  return (
    <Card sx={{ maxWidth: 380, margin: '20px auto', textAlign: 'center' }}>
      <CardMedia component="img" image={dogImage} alt="Perro Candidato" />
      <button
        onClick={handleGetAnotherDog}
        className="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md focus:outline-none mx-auto flex items-center justify-center "
      >
        Obtener otro perro
      </button>
    </Card>
  );
};

export default ImagenPerro;



  