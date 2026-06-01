# suryateja.pro — Node 20 + Express + better-sqlite3 + nodemailer
FROM node:20-alpine AS base
WORKDIR /app

# Build deps for better-sqlite3
RUN apk add --no-cache --virtual .build-deps python3 make g++ \
  && apk add --no-cache tini

COPY package*.json ./
RUN npm install --omit=dev \
  && apk del .build-deps

COPY server.js ./
COPY public ./public

ENV NODE_ENV=production \
    PORT=3000 \
    DB_PATH=/data/contact.sqlite

RUN mkdir -p /data \
  && addgroup -S app && adduser -S app -G app \
  && chown -R app:app /app /data

USER app
EXPOSE 3000
VOLUME ["/data"]

ENTRYPOINT ["/sbin/tini", "--"]
CMD ["node", "server.js"]

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD wget -qO- http://localhost:3000/health >/dev/null 2>&1 || exit 1
