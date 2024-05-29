FROM python:3
MAINTAINER Aaron Reyes Rodriguez "areyesro@uoregon.edu"
RUN apt-get update -y
RUN apt-get install -y python3-pip python3-dev build-essential
ADD . /app
WORKDIR /app
RUN pip install -r requirements.txt
