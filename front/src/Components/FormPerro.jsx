import 'tailwindcss/tailwind.css';
import { PhotoIcon} from '@heroicons/react/24/solid'
import { useForm } from "react-hook-form";

export default function FormPerro() {
  const {
    register,
    handleSubmit,
    formState: { errors },
    setValue,
    reset,
  } = useForm({
    defaultValues: {
      nombre: "",
      rutpostulante: "",
      email: "",
      nombreEmpresa: "",
      rutempresa: "",
      direccionEmpresa: "",
      tipoPatente: "",
      certificadoResidencia: "",
      certificadoConstitucion: "",
      fotocopiaCarnet: "",
      certificadoArriendo: ""
    },
  });

  const onSubmit = handleSubmit((data) => {
    console.log(data);
    reset();
  });


  return (
    <div className="mt-10">
    <form className="mx-auto max-w-sm" onSubmit={onSubmit}>
      <div className="space-y-4">
        <div>
        <h2 className="text-base font-semibold leading-9 text-gray-900 text-center">Postulación</h2>
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
             {errors.descripcion&& (<span className="text-red-500 text-sm">{errors.descripcion.message}</span>
              )}
              </div>
            </div>

            <div className="col-span-full">
              <label htmlFor="Fotourl" className="block text-sm font-medium leading-6 text-gray-900">
                Foto (url)
              </label>
              <div className="mt-2">
                <input
                  id="Fotourl"
                  name="Fotourl"
                  type="Fotourl"
                  className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  {...register("Fotourl", {
                    required: {
                      value: true,
                      message: "El Foto url es requerido",
                    },
                    })}
                />
                {errors.email && (
                  <span className='text-red-500 text-sm'>{errors.email.message}</span>
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
  )
}