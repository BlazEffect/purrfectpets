FROM node:18.16.0

COPY ./build/frontend/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
CMD ["npm", "run", "dev"]
