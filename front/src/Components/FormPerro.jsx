import 'tailwindcss/tailwind.css';
import { useForm } from "react-hook-form";
import axios from 'axios';
import { useState } from 'react';
import ImagenPerro from './ImagenDog';

export default function FormPerro() {
  const [dogImageUrl, setDogImageUrl] = useState('');

  const {
    register,
    handleSubmit,
    formState: { errors },
    setValue,
    reset,
  } = useForm({
    defaultValues: {
      nombre: "",
      descripcion: "",
      foto_url: "",
    },
  });

  const handleImageUrlChange = (url) => {
    setDogImageUrl(url);
    setValue("foto_url", url);
  };

  const onSubmit = handleSubmit(async (data) => {
    try {
      data.foto_url = dogImageUrl;

      const response = await axios.post('http://127.0.0.1:8000/api/perro/newPerro', data);
      console.log(response.data);
      reset();
    } catch (error) {
      console.error('Error al enviar los datos:', error.response.data);
    }
  });

  return (
    <div className="mt-20 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <ImagenPerro onImageUrlChange={handleImageUrlChange} />
      </div>
      <div className="mx-auto max-w-sm">
      <form className="col-span-6 mx-auto max-w-sm" onSubmit={onSubmit}>
          <div className="space-y-4">
            <div>
            <h2 className="text-base font-semibold leading-9 text-gray-900 text-center">Registrar Perro</h2>
            </div>

            <div className="border-b border-gray-900/10 pb-8">
              <div className="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                <div className="col-span-full">
              <label htmlFor="nombre completo" className="block text-sm font-medium leading-6 text-gray-900">
                Nombre completo
              </label>
              <div className="mt-2">
              <input
              type="text"
              name="nombre"
              id="nombre"
              className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              {...register("nombre", {
                required: {
                  value: true,
                  message: "Nombre completo es requerido",
                },
                maxLength: {
                  value: 20,
                  message: "Nombre debe tener máximo 20 caracteres",
                },
                minLength: {
                  value: 2,
                  message: "Nombre debe tener mínimo 2 caracteres",
                },
                pattern: {
                  value: /^[A-Za-z ]+$/,
                  message: "Nombre solo puede contener letras y espacios",
                },
              })}
            />
              {errors.nombre && (
                <span className="text-red-500 text-sm">{errors.nombre.message}</span>
              )}
              </div>
            </div>


                <div className="col-span-full">
                  <label htmlFor="descripcion" className="block text-sm font-medium leading-6 text-gray-900">
                    Descripción
                  </label>
                  <div className="mt-2">
                  <input
                  type="text" 
                  name="descripcion"
                  className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  {...register("descripcion", {
                    required: {
                      value: true,
                      message: "La descripcion es requerida",
                    },
                  })}
                />
                {errors.descripcion&& (<span className="text-black text-sm">{errors.descripcion.message}</span>
                  )}
                  </div>
                </div>

               

                </div>

              

            <div className="mt-6 flex items-center justify-center gap-x-6">
                <button
                type="submit"
                className="rounded-md bg-indigo-600 px-8 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                Enviar
                </button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  );
}




 