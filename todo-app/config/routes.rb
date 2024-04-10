Rails.application.routes.draw do
  resources :todos
  get 'tips', to: 'tips#index'
  root 'todos#index'
end


