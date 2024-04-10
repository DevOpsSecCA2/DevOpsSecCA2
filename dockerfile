# Use an official Ruby runtime as a parent image
FROM ruby:2.7

# Set environment variables
ENV RAILS_ROOT /var/www/todo_app
ENV LANG C.UTF-8
ENV TZ UTC

# Set working directory
WORKDIR $RAILS_ROOT

# Install dependencies
RUN apt-get update -qq && apt-get install -y nodejs postgresql-client

# Install bundler and gems
RUN gem install bundler
COPY Gemfile* ./
RUN bundle install

# Copy the current directory contents into the container
COPY . .

# Start the Rails server
CMD ["bundle", "exec", "rails", "server", "-b", "0.0.0.0"]
